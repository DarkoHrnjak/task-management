import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['output'];

    connect() {
        this.outputTarget.textContent = 'Controller connected!';
    }

    async submitData() {
        const response = await fetch('/api/submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: 'Hello Symfony!' })
        });
        const data = await response.json();
        this.outputTarget.textContent = data.message;
    }
}
