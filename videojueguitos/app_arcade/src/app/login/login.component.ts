
import { Component } from '@angular/core';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  credentials = { username: '', password: '' };

  constructor(private authService: AuthService) { }

  onSubmit() {
    this.authService.login(this.credentials).subscribe(
      (response) => {
        // Manejar la respuesta del servidor (guardar token, redireccionar, etc.)
        console.log('Autenticación exitosa', response);
      },
      (error) => {
        console.log(this.credentials);
        console.log('Error de autenticación', error);
      }
    );
  }
}