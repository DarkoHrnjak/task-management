import { Application } from '@hotwired/stimulus';
import TaskController from './TaskController'; // Ensure this points to your actual controller JS file

const application = Application.start();

// Register your controllers here
application.register('task', TaskController); // Use 'task' as the name for your controller
