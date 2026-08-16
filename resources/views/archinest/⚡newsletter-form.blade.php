<?php

use App\Models\NewsletterSubscriber;
use Illuminate\Support\Str;
use Livewire\Component;

new class extends Component {
    public string $email = '';
    public bool $subscribed = false;
    public string $message = '';

    public function subscribe(): void
    {
        $this->validate([
            'email' => 'required|email|max:150',
        ]);

        $subscriber = NewsletterSubscriber::where('email', $this->email)->first();

        if ($subscriber) {
            if ($subscriber->is_active) {
                $this->message = __('Vous êtes déjà inscrit à notre newsletter.');
            } else {
                $subscriber->update([
                    'is_active'     => true,
                    'subscribed_at' => now(),
                ]);
                $this->message = __('Votre inscription a été réactivée avec succès.');
            }
        } else {
            NewsletterSubscriber::create([
                'email'             => $this->email,
                'is_active'         => true,
                'unsubscribe_token' => Str::random(32),
                'subscribed_at'     => now(),
                'preferences'       => ['recherche', 'actualites', 'opportunites'],
            ]);
            $this->message = __('Merci pour votre inscription à la lettre d\'information CARICS.');
        }

        $this->reset('email');
        $this->subscribed = true;
    }
};
?>

<div>
    @if ($subscribed)
        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-0 rounded-pill shadow-sm" role="alert" style="font-size: .88rem;">
            <i class="bi bi-check-circle-fill me-2 fs-6"></i>
            <div>{{ $message }}</div>
        </div>
    @else
        <form wire:submit="subscribe" class="d-flex flex-column flex-sm-row gap-2">
            <div class="flex-grow-1 position-relative">
                <input type="email" wire:model="email" class="form-control rounded-pill px-3 py-2 @error('email') is-invalid @enderror"
                    placeholder="Votre adresse email..." aria-label="Votre email">
                @error('email')
                    <div class="invalid-feedback position-absolute start-0" style="bottom:-20px; font-size:.78rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 text-nowrap shadow-sm" wire:loading.attr="disabled">
                <span wire:loading.remove>S'abonner <i class="bi bi-arrow-right ms-1"></i></span>
                <span wire:loading><i class="fa fa-spinner fa-spin"></i></span>
            </button>
        </form>
    @endif
</div>
