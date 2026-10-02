@extends('layouts.app')

@section('title', 'Python Sandbox & Playground — Edify')
@section('meta_description', 'Tulis dan jalankan kode program Python secara langsung di browser tanpa instalasi di Edify Python Playground.')

@section('content')
<div class="playground-wrapper">

    {{-- Subtle Ambient Background Glow (Edify Theme) --}}
    <div class="playground-glow" aria-hidden="true"></div>

    <div class="container-md">

        {{-- ============================================================
             HERO HEADER (Clean, Minimalist & Simple)
        ============================================================ --}}
        <div class="playground-hero">
            <div class="hero-badge">
                <span class="pulse-dot"></span>
                <span>Python 3.11 Sandbox &bull; Real-time</span>
            </div>

            <h1 class="hero-title">
                Python Code <span class="gradient-text">Playground</span>
            </h1>

            <p class="hero-subtitle">
                Tulis dan jalankan kode Python secara instan di peramban tanpa perlu instalasi atau konfigurasi lokal.
            </p>
        </div>

        {{-- ============================================================
             CLEAN ACTION BAR (Minimalist: Status + Run Button)
        ============================================================ --}}
        <div class="playground-action-bar">
            <div class="action-status-pill">
                <span class="status-indicator-dot"></span>
                <span class="status-label-text">Engine Siap</span>
                <span class="status-sep">&bull;</span>
                <span class="status-version">Python 3.11</span>
            </div>

            {{-- Primary Action: Run Code --}}
            <button type="button" class="btn-run-primary" id="btnRunCode">
                <span class="run-spinner" id="runSpinner" style="display: none;"></span>
                <i data-lucide="play" class="run-icon" id="runIcon"></i>
                <span class="run-label" id="runLabel">Jalankan Kode</span>
                <kbd class="run-kbd">Ctrl+Enter</kbd>
            </button>
        </div>

        {{-- ============================================================
             WORKSPACE: Split-Screen Code Editor + Terminal Output
        ============================================================ --}}
        <div class="workspace-card">

            {{-- LEFT COLUMN: Code Editor --}}
            <div class="workspace-pane editor-pane">
                {{-- Editor Header --}}
                <div class="pane-header">
                    <div class="pane-header-left">
                        <div class="file-tab">
                            {{-- Python SVG Icon --}}
                            <svg class="python-svg" viewBox="0 0 24 24" width="16" height="16" fill="none">
                                <path d="M12 2C6.48 2 6 3.5 6 5.5v2.25h6V9H4.25C2.25 9 1 10.25 1 12.25s1.25 3.25 3.25 3.25H6V17c0 2 1.5 3.5 6 3.5 4.5 0 6-1.5 6-3.5v-2.25h-6V13h7.75c2 0 3.25-1.25 3.25-3.25S21.75 6.5 19.75 6.5H18V5.5c0-2-1.5-3.5-6-3.5z" fill="#38bdf8"/>
                                <path d="M9.5 4.25a.75.75 0 110 1.5.75.75 0 010-1.5zm5 14a.75.75 0 110 1.5.75.75 0 010-1.5z" fill="#fbbf24"/>
                            </svg>
                            <span class="tab-filename">main.py</span>
                        </div>
                    </div>
                    <div class="pane-header-right">
                        <span class="meta-indicator" id="cursorPosIndicator">Baris 1, Kolom 1</span>
                    </div>
                </div>

                {{-- Editor Body (Gutter + Textarea) --}}
                <div class="editor-area">
                    <div class="editor-gutter" id="editorGutter" aria-hidden="true">
                        <span>1</span>
                    </div>
                    <textarea
                        id="codeEditor"
                        class="editor-textarea"
                        spellcheck="false"
                        autocomplete="off"
                        autocorrect="off"
                        autocapitalize="off"
                        placeholder="# Tuliskan kode Python Anda di sini..."
                    >{{ $defaultCode }}</textarea>
                </div>
            </div>

            {{-- RIGHT COLUMN: Terminal Output --}}
            <div class="workspace-pane terminal-pane">
                {{-- Terminal Header --}}
                <div class="pane-header terminal-header">
                    <div class="pane-header-left">
                        <div class="terminal-dots" aria-hidden="true">
                            <span class="dot dot-close"></span>
                            <span class="dot dot-minimize"></span>
                            <span class="dot dot-maximize"></span>
                        </div>
                        <span class="terminal-title">Terminal Console</span>
                    </div>

                    <div class="pane-header-right">
                        {{-- Status Pill --}}
                        <div class="terminal-status-pill status-ready" id="terminalStatusPill">
                            <span class="status-bullet"></span>
                            <span class="status-text" id="terminalStatusText">Siap</span>
                        </div>

                        {{-- Execution Runtime Metric --}}
                        <div class="runtime-badge" id="runtimeBadge" style="display: none;">
                            <i data-lucide="timer"></i>
                            <span id="runtimeText">0.00s</span>
                        </div>

                        {{-- Clear Terminal Button --}}
                        <button type="button" class="btn-clear-term" id="btnClearTerminal" title="Bersihkan Output Terminal">
                            <i data-lucide="trash-2"></i>
                        </button>
                    </div>
                </div>

                {{-- Terminal Body --}}
                <div class="terminal-body" id="terminalBody">

                    {{-- Empty State Placeholder --}}
                    <div class="terminal-placeholder" id="terminalPlaceholder">
                        <div class="placeholder-icon">
                            <i data-lucide="play-circle"></i>
                        </div>
                        <h4 class="placeholder-title">Konsol Siap Digunakan</h4>
                        <p class="placeholder-desc">
                            Klik tombol <span class="placeholder-highlight">"Jalankan Kode"</span> atau tekan shortcut <kbd>Ctrl</kbd> + <kbd>Enter</kbd> untuk mengeksekusi program.
                        </p>
                    </div>

                    {{-- Loading / Executing State --}}
                    <div class="terminal-executing" id="terminalExecuting" style="display: none;">
                        <div class="exec-spinner"></div>
                        <div class="exec-text">Mengeksekusi kode Python...</div>
                        <div class="exec-subtext">Memproses di sandbox cloud Edify</div>
                    </div>

                    {{-- Actual Output Container --}}
                    <div class="terminal-output" id="terminalOutput" style="display: none;">
                        {{-- Standard Output (stdout) --}}
                        <div class="output-stdout" id="stdoutWrapper">
                            <pre><code id="stdoutContent"></code></pre>
                        </div>

                        {{-- Standard Error (stderr) --}}
                        <div class="output-stderr" id="stderrWrapper" style="display: none;">
                            <div class="stderr-header">
                                <i data-lucide="alert-triangle"></i>
                                <span>Traceback / Runtime Error:</span>
                            </div>
                            <pre><code id="stderrContent"></code></pre>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- ============================================================
             FEATURE HIGHLIGHTS (Clean 3-Card Minimal Grid)
        ============================================================ --}}
        <div class="playground-features-grid">
            <div class="feature-card">
                <div class="feature-icon-box">
                    <i data-lucide="zap"></i>
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">Eksekusi Instan</h3>
                    <p class="feature-desc">Kode dijalankan langsung di cloud sandbox dengan hasil real-time.</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">
                    <i data-lucide="package-check"></i>
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">Pustaka Python Standar</h3>
                    <p class="feature-desc">Mendukung modul standar seperti <code>math</code>, <code>random</code>, <code>json</code>, dan <code>datetime</code>.</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">
                    <i data-lucide="keyboard"></i>
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">Pintasan Keyboard</h3>
                    <p class="feature-desc">Jalankan kode lebih cepat dengan menekan tombol <kbd>Ctrl + Enter</kbd>.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    /* ============================================================
       EDIFY DESIGN SYSTEM - PYTHON PLAYGROUND SPECIFICATION
    ============================================================ */

    :root {
        --code-font: 'JetBrains Mono', 'Fira Code', 'SF Mono', Menlo, Monaco, Consolas, monospace;
        --pane-height: 560px;
    }

    .playground-wrapper {
        position: relative;
        padding: 2.75rem 0 5rem;
        overflow: hidden;
    }

    /* Ambient background radial glow */
    .playground-glow {
        position: absolute;
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        width: 760px;
        height: 360px;
        background: radial-gradient(ellipse at center, rgba(99, 102, 241, 0.12), transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    /* ============================================================
       HERO SECTION
    ============================================================ */
    .playground-hero {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 1rem;
        border: 1px solid var(--color-border);
        border-radius: 9999px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--color-text-muted);
        background: rgba(99, 102, 241, 0.04);
        backdrop-filter: blur(8px);
        margin-bottom: 1.25rem;
    }

    .hero-title {
        font-size: clamp(2rem, 4.5vw, 3rem);
        font-weight: 800;
        letter-spacing: -0.03em;
        line-height: 1.15;
        color: var(--color-text);
        margin-bottom: 0.75rem;
    }

    .gradient-text {
        background: linear-gradient(135deg, #6366f1 20%, #a855f7 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: clamp(0.95rem, 1.5vw, 1.05rem);
        color: var(--color-text-muted);
        max-width: 36rem;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ============================================================
       CLEAN ACTION BAR (Status + Run Button)
    ============================================================ */
    .playground-action-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .action-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        background: var(--color-bg);
        border: 1px solid var(--color-border);
        border-radius: 9999px;
        font-size: 0.8125rem;
        color: var(--color-text-muted);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }
    .status-indicator-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.18);
    }
    .status-label-text {
        font-weight: 600;
        color: var(--color-text);
    }
    .status-sep {
        opacity: 0.4;
    }
    .status-version {
        font-size: 0.75rem;
        font-family: var(--code-font);
    }

    /* Primary Run Code Button */
    .btn-run-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.4rem;
        background: var(--color-primary);
        color: #ffffff;
        border: none;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(99, 102, 241, 0.32);
        transition: all var(--transition);
        user-select: none;
    }
    .btn-run-primary:hover:not(:disabled) {
        background: var(--color-primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.45);
    }
    .btn-run-primary:disabled {
        opacity: 0.65;
        cursor: not-allowed;
        transform: none;
    }
    .run-icon {
        width: 15px;
        height: 15px;
        fill: currentColor;
    }
    .run-kbd {
        font-family: inherit;
        font-size: 0.7rem;
        background: rgba(255, 255, 255, 0.22);
        padding: 0.15rem 0.45rem;
        border-radius: 6px;
        margin-left: 0.15rem;
        font-weight: 500;
        letter-spacing: 0.02em;
    }
    .run-spinner {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: #ffffff;
        animation: spin 0.7s linear infinite;
    }

    /* ============================================================
       WORKSPACE CONTAINER & PANES
    ============================================================ */
    .workspace-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: var(--color-border);
        border: 1px solid var(--color-border);
        border-radius: var(--radius);
        gap: 1px;
        overflow: hidden;
        box-shadow: 0 8px 30px -4px rgba(0, 0, 0, 0.06);
        min-height: var(--pane-height);
        position: relative;
        z-index: 1;
    }

    .workspace-pane {
        background: var(--color-bg);
        display: flex;
        flex-direction: column;
        min-height: var(--pane-height);
    }

    /* Pane Header */
    .pane-header {
        height: 44px;
        padding: 0 1.25rem;
        background: var(--color-bg);
        border-bottom: 1px solid var(--color-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        user-select: none;
    }

    .pane-header-left,
    .pane-header-right {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .file-tab {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-family: var(--code-font);
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--color-text);
    }

    .meta-indicator {
        font-family: var(--code-font);
        font-size: 0.75rem;
        color: var(--color-text-muted);
    }

    /* ============================================================
       EDITOR AREA (Gutter + Textarea)
    ============================================================ */
    .editor-area {
        flex: 1;
        display: flex;
        position: relative;
        background: var(--color-bg);
        overflow: hidden;
    }

    .editor-gutter {
        width: 48px;
        min-width: 48px;
        padding: 1.125rem 0.65rem 1.125rem 0;
        text-align: right;
        font-family: var(--code-font);
        font-size: 0.8125rem;
        line-height: 1.65;
        color: var(--color-text-muted);
        opacity: 0.45;
        border-right: 1px solid var(--color-border);
        user-select: none;
        overflow: hidden;
    }
    .editor-gutter span {
        display: block;
    }

    .editor-textarea {
        flex: 1;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        padding: 1.125rem 1.25rem 2rem 1.25rem;
        font-family: var(--code-font);
        font-size: 0.8125rem;
        line-height: 1.65;
        color: var(--color-text);
        resize: none;
        white-space: pre;
        overflow-wrap: normal;
        overflow-x: auto;
        tab-size: 4;
    }

    /* ============================================================
       TERMINAL PANE & CONSOLE
    ============================================================ */
    .terminal-pane {
        background: #090d16;
        color: #f8fafc;
    }

    .terminal-header {
        background: #0d121f;
        border-bottom: 1px solid #1e293b;
    }

    .terminal-dots {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        margin-right: 0.5rem;
    }
    .terminal-dots .dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
    }
    .dot-close    { background: #ef4444; }
    .dot-minimize { background: #f59e0b; }
    .dot-maximize { background: #10b981; }

    .terminal-title {
        font-size: 0.775rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #cbd5e1;
    }

    /* Status Pill */
    .terminal-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.2rem 0.65rem;
        border-radius: 9999px;
        font-size: 0.725rem;
        font-weight: 600;
        letter-spacing: 0.01em;
    }
    .status-bullet {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-ready {
        background: rgba(148, 163, 184, 0.15);
        color: #94a3b8;
    }
    .status-ready .status-bullet { background: #94a3b8; }

    .status-running {
        background: rgba(245, 158, 11, 0.18);
        color: #fbbf24;
    }
    .status-running .status-bullet {
        background: #f59e0b;
        animation: pulse 1s infinite;
    }

    .status-success {
        background: rgba(16, 185, 129, 0.18);
        color: #34d399;
    }
    .status-success .status-bullet { background: #10b981; }

    .status-error {
        background: rgba(239, 68, 68, 0.18);
        color: #f87171;
    }
    .status-error .status-bullet { background: #ef4444; }

    /* Runtime Badge */
    .runtime-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.15rem 0.5rem;
        border-radius: 6px;
        font-family: var(--code-font);
        font-size: 0.7rem;
        color: #94a3b8;
    }
    .runtime-badge svg {
        width: 12px;
        height: 12px;
    }

    .btn-clear-term {
        background: transparent;
        border: none;
        color: #64748b;
        cursor: pointer;
        padding: 0.2rem;
        display: flex;
        border-radius: 4px;
        transition: color 0.15s;
    }
    .btn-clear-term:hover {
        color: #f87171;
    }
    .btn-clear-term svg {
        width: 14px;
        height: 14px;
    }

    /* Terminal Body Content */
    .terminal-body {
        flex: 1;
        padding: 1.25rem;
        overflow-y: auto;
        position: relative;
        font-family: var(--code-font);
    }

    /* Empty Placeholder */
    .terminal-placeholder {
        text-align: center;
        max-width: 340px;
        margin: 6rem auto 0 auto;
        color: #64748b;
    }
    .placeholder-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #818cf8;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem auto;
    }
    .placeholder-icon svg {
        width: 22px;
        height: 22px;
    }
    .placeholder-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #e2e8f0;
        margin-bottom: 0.4rem;
    }
    .placeholder-desc {
        font-size: 0.8125rem;
        line-height: 1.55;
    }
    .placeholder-highlight {
        color: #a5b4fc;
        font-weight: 600;
    }
    .placeholder-desc kbd {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 0.1rem 0.35rem;
        border-radius: 4px;
        font-size: 0.75rem;
        color: #cbd5e1;
    }

    /* Executing Overlay */
    .terminal-executing {
        position: absolute;
        inset: 0;
        background: rgba(9, 13, 22, 0.85);
        backdrop-filter: blur(4px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        z-index: 5;
    }
    .exec-spinner {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 3px solid rgba(99, 102, 241, 0.2);
        border-top-color: var(--color-primary);
        animation: spin 0.8s linear infinite;
    }
    .exec-text {
        font-size: 0.875rem;
        font-weight: 700;
        color: #f1f5f9;
    }
    .exec-subtext {
        font-size: 0.75rem;
        color: #64748b;
    }

    /* Stdout & Stderr Output */
    .output-stdout pre {
        margin: 0;
        color: #4ade80;
        font-family: var(--code-font);
        font-size: 0.85rem;
        line-height: 1.65;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .output-stderr {
        margin-top: 1rem;
        padding: 0.85rem 1rem;
        background: rgba(239, 68, 68, 0.08);
        border-left: 3px solid #ef4444;
        border-radius: 0 6px 6px 0;
    }
    .stderr-header {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.725rem;
        font-weight: 700;
        color: #f87171;
        margin-bottom: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .stderr-header svg {
        width: 14px;
        height: 14px;
    }
    .output-stderr pre {
        margin: 0;
        color: #fca5a5;
        font-family: var(--code-font);
        font-size: 0.8125rem;
        line-height: 1.55;
        white-space: pre-wrap;
        word-break: break-word;
    }

    /* ============================================================
       FEATURE HIGHLIGHTS CARDS (Bottom Strip)
    ============================================================ */
    .playground-features-grid {
        margin-top: 2.75rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        position: relative;
        z-index: 1;
    }

    .feature-card {
        background: var(--color-bg);
        border: 1px solid var(--color-border);
        border-radius: var(--radius);
        padding: 1.25rem 1.35rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        transition: transform var(--transition), border-color var(--transition);
    }
    .feature-card:hover {
        transform: translateY(-2px);
        border-color: var(--color-primary);
    }

    .feature-icon-box {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(99, 102, 241, 0.08);
        color: var(--color-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .feature-icon-box svg {
        width: 18px;
        height: 18px;
    }

    .feature-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 0.25rem;
    }
    .feature-desc {
        font-size: 0.8125rem;
        color: var(--color-text-muted);
        line-height: 1.5;
        margin: 0;
    }
    .feature-desc code {
        background: rgba(99, 102, 241, 0.08);
        color: var(--color-primary);
        padding: 0.05rem 0.3rem;
        border-radius: 4px;
        font-family: var(--code-font);
        font-size: 0.75rem;
    }

    /* Keyframes */
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    /* Responsive */
    @media (max-width: 960px) {
        .workspace-card {
            grid-template-columns: 1fr;
        }
        .playground-features-grid {
            grid-template-columns: 1fr;
        }
        .run-kbd {
            display: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    /* Elements */
    const codeEditor          = document.getElementById('codeEditor');
    const editorGutter        = document.getElementById('editorGutter');
    const btnRunCode          = document.getElementById('btnRunCode');
    const runSpinner          = document.getElementById('runSpinner');
    const runIcon             = document.getElementById('runIcon');
    const runLabel            = document.getElementById('runLabel');
    const btnClearTerminal    = document.getElementById('btnClearTerminal');
    const cursorPosIndicator  = document.getElementById('cursorPosIndicator');

    // Terminal Elements
    const terminalPlaceholder = document.getElementById('terminalPlaceholder');
    const terminalOutput      = document.getElementById('terminalOutput');
    const terminalExecuting   = document.getElementById('terminalExecuting');
    const stdoutWrapper       = document.getElementById('stdoutWrapper');
    const stdoutContent       = document.getElementById('stdoutContent');
    const stderrWrapper       = document.getElementById('stderrWrapper');
    const stderrContent       = document.getElementById('stderrContent');
    const terminalStatusPill  = document.getElementById('terminalStatusPill');
    const terminalStatusText  = document.getElementById('terminalStatusText');
    const runtimeBadge        = document.getElementById('runtimeBadge');
    const runtimeText         = document.getElementById('runtimeText');

    const RUN_URL    = "{{ route('playground.run') }}";
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const STORAGE_KEY = 'edify_playground_code_v4';

    let isExecuting = false;

    // Restore saved code from localStorage or use default
    const savedCode = localStorage.getItem(STORAGE_KEY);
    if (savedCode && savedCode.trim()) {
        codeEditor.value = savedCode;
    }

    /* Gutter & Line Numbers Sync */
    function updateGutter() {
        const lines = codeEditor.value.split('\n');
        const count = lines.length;
        let html = '';
        for (let i = 1; i <= count; i++) {
            html += `<span>${i}</span>`;
        }
        editorGutter.innerHTML = html;
    }

    function syncGutterScroll() {
        editorGutter.scrollTop = codeEditor.scrollTop;
    }

    function updateCursorIndicator() {
        const text = codeEditor.value;
        const pos  = codeEditor.selectionStart;
        const lines = text.substring(0, pos).split('\n');
        const currentLine = lines.length;
        const currentCol  = lines[lines.length - 1].length + 1;
        cursorPosIndicator.textContent = `Baris ${currentLine}, Kolom ${currentCol}`;
    }

    codeEditor.addEventListener('input', () => {
        updateGutter();
        localStorage.setItem(STORAGE_KEY, codeEditor.value);
    });

    codeEditor.addEventListener('scroll', syncGutterScroll);
    codeEditor.addEventListener('click', updateCursorIndicator);
    codeEditor.addEventListener('keyup', updateCursorIndicator);

    /* Keyboard Shortcuts & Smart Indent */
    codeEditor.addEventListener('keydown', (e) => {
        // Ctrl + Enter or Cmd + Enter to Run
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            executeCode();
            return;
        }

        // Tab: 4 spaces indent/outdent
        if (e.key === 'Tab') {
            e.preventDefault();
            const start = codeEditor.selectionStart;
            const end   = codeEditor.selectionEnd;

            if (!e.shiftKey) {
                codeEditor.setRangeText('    ', start, end, 'end');
            } else {
                const text = codeEditor.value;
                const lineStart = text.lastIndexOf('\n', start - 1) + 1;
                if (text.substr(lineStart, 4) === '    ') {
                    codeEditor.setRangeText('', lineStart, lineStart + 4, 'end');
                }
            }
            updateGutter();
            updateCursorIndicator();
            localStorage.setItem(STORAGE_KEY, codeEditor.value);
            return;
        }

        // Auto-close brackets & quotes
        const pairs = { '(': ')', '[': ']', '{': '}', '"': '"', "'": "'" };
        if (pairs[e.key]) {
            const start = codeEditor.selectionStart;
            const end   = codeEditor.selectionEnd;
            if (start === end) {
                e.preventDefault();
                const char = e.key;
                const closeChar = pairs[char];
                codeEditor.setRangeText(char + closeChar, start, end, 'end');
                codeEditor.selectionStart = codeEditor.selectionEnd = start + 1;
                localStorage.setItem(STORAGE_KEY, codeEditor.value);
                return;
            }
        }

        // Auto-indent on Enter
        if (e.key === 'Enter') {
            const start = codeEditor.selectionStart;
            const text  = codeEditor.value;
            const lineStart = text.lastIndexOf('\n', start - 1) + 1;
            const currentLine = text.substring(lineStart, start);
            const indentMatch = currentLine.match(/^\s*/);
            const indent = indentMatch ? indentMatch[0] : '';
            const shouldExtraIndent = currentLine.trim().endsWith(':');

            e.preventDefault();
            const extra = shouldExtraIndent ? '    ' : '';
            codeEditor.setRangeText('\n' + indent + extra, start, start, 'end');
            updateGutter();
            updateCursorIndicator();
            localStorage.setItem(STORAGE_KEY, codeEditor.value);
            return;
        }
    });

    btnClearTerminal.addEventListener('click', clearTerminal);

    function clearTerminal() {
        terminalPlaceholder.style.display = 'block';
        terminalOutput.style.display      = 'none';
        stdoutWrapper.style.display       = 'none';
        stderrWrapper.style.display       = 'none';
        stdoutContent.textContent         = '';
        stderrContent.textContent         = '';
        runtimeBadge.style.display        = 'none';
        setStatusPill('ready', 'Siap');
    }

    function setStatusPill(type, label) {
        terminalStatusPill.className = 'terminal-status-pill status-' + type;
        terminalStatusText.textContent = label;
    }

    /* Execute Code via Server Sandbox */
    async function executeCode() {
        const code = codeEditor.value.trim();
        if (!code || isExecuting) return;

        isExecuting = true;
        btnRunCode.disabled = true;
        runSpinner.style.display = 'inline-block';
        runIcon.style.display    = 'none';
        runLabel.textContent     = 'Menjalankan...';

        terminalExecuting.style.display = 'flex';
        setStatusPill('running', 'Menjalankan...');

        try {
            const response = await fetch(RUN_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    source_code: code,
                    stdin: ''
                })
            });

            const data = await response.json();

            terminalExecuting.style.display   = 'none';
            terminalPlaceholder.style.display = 'none';
            terminalOutput.style.display      = 'block';

            const stdout = (data.stdout || '').trim();
            const stderr = (data.stderr || '').trim();

            if (stdout) {
                stdoutWrapper.style.display = 'block';
                stdoutContent.textContent   = stdout;
            } else {
                stdoutWrapper.style.display = 'none';
                stdoutContent.textContent   = '';
            }

            if (stderr) {
                stderrWrapper.style.display = 'block';
                stderrContent.textContent   = stderr;
            } else {
                stderrWrapper.style.display = 'none';
                stderrContent.textContent   = '';
            }

            if (!stdout && !stderr) {
                stdoutWrapper.style.display = 'block';
                stdoutContent.textContent   = '# Program selesai dieksekusi tanpa keluaran teks (exit code: 0).';
            }

            if (data.execution_time) {
                runtimeBadge.style.display = 'inline-flex';
                runtimeText.textContent    = data.execution_time;
            }

            if (data.success) {
                setStatusPill('success', 'Selesai (' + (data.execution_time || '0s') + ')');
            } else {
                setStatusPill('error', data.status || 'Error');
            }

        } catch (err) {
            console.error('Execution error:', err);
            terminalExecuting.style.display   = 'none';
            terminalPlaceholder.style.display = 'none';
            terminalOutput.style.display      = 'block';
            stdoutWrapper.style.display       = 'none';
            stderrWrapper.style.display       = 'block';
            stderrContent.textContent         = 'Gagal terhubung ke engine sandbox: ' + err.message;
            setStatusPill('error', 'Koneksi Gagal');
        } finally {
            isExecuting = false;
            btnRunCode.disabled = false;
            runSpinner.style.display = 'none';
            runIcon.style.display    = 'inline-block';
            runLabel.textContent     = 'Jalankan Kode';
        }
    }

    btnRunCode.addEventListener('click', executeCode);

    // Initial render
    updateGutter();
    updateCursorIndicator();
    if (window.lucide) {
        lucide.createIcons();
    }
});
</script>
@endpush
