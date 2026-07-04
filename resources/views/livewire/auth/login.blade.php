<div
    x-data="{
        timer: @entangle('expiresIn'),
        step: @entangle('step'),
        interval: null,

        startTimer() {
            if (this.interval) {
                clearInterval(this.interval);
            }

            if (this.step !== 2) return;

            this.interval = setInterval(() => {
                if (this.timer <= 0) {
                    clearInterval(this.interval);
                    this.interval = null;
                    return;
                }
                this.timer--;
            }, 1000);
        }
    }"
    x-init="
        $watch('step', () => startTimer());
    "
    @start-timer.window="startTimer()"
    class="min-h-screen flex items-center justify-center bg-gray-100"
    >
    <div class="w-full max-w-md bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-bold mb-6 text-center">
            OTP Login
        </h2>

        <form wire:submit.prevent="{{ $step === 1 ? 'sendOtp' : 'login' }}" class="space-y-4">

            {{-- Mobile --}}
            <x-input
                label="Mobile"
                placeholder="Enter your mobile"
                wire:model.defer="mobile"
                icon="phone"
                :disabled="$step === 2"
            />

            {{-- OTP --}}
            @if($step === 2)
                <div class="space-y-2">

                    <x-input
                        label="Code"
                        placeholder="Enter OTP code"
                        wire:model.defer="code"
                        icon="lock-closed"
                    />

                    <div class="text-sm text-gray-600">
                        Code expires in:
                        <span class="font-bold text-red-500" x-text="timer"></span>s
                    </div>
                </div>
            @endif

            {{-- Remember --}}
            <x-checkbox
                label="Remember me"
                wire:model.defer="remember"
            />

            {{-- Button --}}
            <x-button
                type="submit"
                primary
                class="w-full"
                spinner
            >
                {{ $step === 1 ? 'Send OTP' : 'Login' }}
            </x-button>

        </form>

    </div>
</div>
