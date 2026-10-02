<?php

namespace App\Http\Controllers;

use App\Services\CodeExecutionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlaygroundController extends Controller
{
    protected CodeExecutionService $executionService;

    public function __construct(CodeExecutionService $executionService)
    {
        $this->executionService = $executionService;
    }

    /**
     * Tampilkan halaman Python Code Playground & Sandbox.
     */
    public function index(): View
    {
        $defaultCode = <<<'PYTHON'
# ========================================================
# Selamat Datang di Edify Python Playground & Sandbox 🚀
# ========================================================

print("Hello World")
PYTHON;

        return view('playground.index', compact('defaultCode'));
    }

    /**
     * Endpoint API untuk mengeksekusi kode Python di Sandbox.
     */
    public function run(Request $request): JsonResponse
    {
        $request->validate([
            'source_code' => 'required|string|max:100000',
            'stdin'       => 'nullable|string|max:10000',
        ]);

        $sourceCode = $request->input('source_code');
        $stdin      = $request->input('stdin', '');

        $result = $this->executionService->executePython($sourceCode, $stdin);

        return response()->json($result);
    }
}
