import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import mask from '@alpinejs/mask';
import focus from '@alpinejs/focus';
import signature from 'signature_pad';

Alpine.plugin([mask, focus]);

Livewire.start()

window.SignaturePad = signature;


