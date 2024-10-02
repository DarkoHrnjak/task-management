import { Application } from '@hotwired/stimulus';

const app = Application.start(); // Change this line
// Register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

// In bootstrap.js
import './controllers';  // Ensure this is included to register controllers
