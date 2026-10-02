<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CodeExecutionService
{
    protected string $baseUrl;
    protected ?string $apiKey;
    protected string $apiHost;

    public function __construct()
    {
        $this->baseUrl = config('services.judge0.base_url') ?: env('JUDGE0_BASE_URL', 'https://ce.judge0.com');
        $this->apiKey  = config('services.judge0.api_key') ?: env('JUDGE0_API_KEY');
        $this->apiHost = config('services.judge0.api_host') ?: env('JUDGE0_API_HOST', 'judge0-ce.p.rapidapi.com');
    }

    /**
     * Eksekusi kode Python melalui Judge0 Sandbox API.
     *
     * @param string $sourceCode Kode Python yang akan dijalankan
     * @param string|null $stdin Input standar opsional (untuk input())
     * @return array
     */
    public function executePython(string $sourceCode, ?string $stdin = ''): array
    {
        $sourceCode = trim($sourceCode);

        if (empty($sourceCode)) {
            return [
                'success'        => false,
                'stdout'         => '',
                'stderr'         => 'Error: Kode program tidak boleh kosong.',
                'status'         => 'Empty Code',
                'status_id'      => 0,
                'execution_time' => '0s',
                'memory'         => '0 KB',
            ];
        }

        // Language ID 92 = Python (3.11.2), fallback 71 = Python (3.8.1)
        $languageId = 92;

        $payload = [
            'source_code' => $sourceCode,
            'language_id' => $languageId,
            'stdin'       => $stdin ?? '',
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        // Jika menggunakan RapidAPI Judge0
        if (!empty($this->apiKey)) {
            $headers['X-RapidAPI-Key']  = $this->apiKey;
            $headers['X-RapidAPI-Host'] = $this->apiHost;
        }

        $url = rtrim($this->baseUrl, '/') . '/submissions?base64_encoded=false&wait=true';

        $startTime = microtime(true);

        try {
            $response = Http::withHeaders($headers)
                ->timeout(15)
                ->post($url, $payload);

            $duration = round((microtime(true) - $startTime), 3);

            if ($response->successful()) {
                $data = $response->json();

                $stdout        = $data['stdout'] ?? '';
                $stderr        = $data['stderr'] ?? '';
                $compileOutput = $data['compile_output'] ?? '';
                $message       = $data['message'] ?? '';
                $statusDesc    = $data['status']['description'] ?? 'Completed';
                $statusId      = $data['status']['id'] ?? 3;
                $timeTaken     = isset($data['time']) ? $data['time'] . 's' : "{$duration}s";
                $memoryUsed    = isset($data['memory']) ? round($data['memory'] / 1024, 2) . ' MB' : '0 MB';

                // Status ID 3 = Accepted
                $isSuccess = ($statusId === 3);

                // Gabungkan pesan error jika ada
                $fullError = trim($stderr . "\n" . $compileOutput . "\n" . $message);

                return [
                    'success'        => $isSuccess,
                    'stdout'         => $stdout,
                    'stderr'         => $fullError,
                    'status'         => $statusDesc,
                    'status_id'      => $statusId,
                    'execution_time' => $timeTaken,
                    'memory'         => $memoryUsed,
                    'token'          => $data['token'] ?? null,
                ];
            }

            // Tangani jika instance sibuk atau error HTTP
            $status = $response->status();
            $body   = $response->json() ?? $response->body();
            $errMsg = is_array($body) ? ($body['message'] ?? json_encode($body)) : $body;

            Log::warning("Judge0 API returned error {$status}: {$errMsg}");

            return [
                'success'        => false,
                'stdout'         => '',
                'stderr'         => "Gagal menghubungi Sandbox Server (HTTP {$status}): " . ($errMsg ?: 'Server timeout.'),
                'status'         => 'Server Error',
                'status_id'      => $status,
                'execution_time' => "{$duration}s",
                'memory'         => '0 MB',
            ];

        } catch (\Exception $e) {
            $duration = round((microtime(true) - $startTime), 3);
            Log::error("CodeExecutionService Exception: " . $e->getMessage());

            return [
                'success'        => false,
                'stdout'         => '',
                'stderr'         => 'Koneksi ke sandbox eksekusi terputus: ' . $e->getMessage(),
                'status'         => 'Connection Timeout',
                'status_id'      => 500,
                'execution_time' => "{$duration}s",
                'memory'         => '0 MB',
            ];
        }
    }
}
