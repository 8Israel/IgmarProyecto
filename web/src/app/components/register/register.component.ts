import { Component } from '@angular/core';
import { Router, RouterModule, RouterOutlet } from '@angular/router';
import { RegisterService } from '../../services/register.service';
import { Register } from '../../interfaces/register';
import { FormsModule } from '@angular/forms';
import { User } from '../../interfaces/user';
import { LoginService } from '../../services/login.service';
import { Title } from '@angular/platform-browser';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [RouterOutlet, RouterModule, FormsModule, CommonModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent {

  constructor(private rs: RegisterService, private title: Title, private router: Router) {
    this.title.setTitle("Registarse")
  }

  emailError: Array<string>|null = null;
  isEmailError: boolean = false;

  passwordError: Array<string>|null = null;
  isPasswordError: boolean = false;

  nameError: Array<string>|null = null;
  isNameError: boolean = false;

  passwordConfirmationError: Array<string>|null = null;
  ispasswordConfirmationError: boolean = false;

  validMessage: string|null = null

  public register: Register = {
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
  }
  
  onSubmit(event: Event) {
    event.preventDefault();
  
    this.rs.Register(this.register).subscribe(
      (response) => {
        this.validMessage = "Registro exitoso";
        this.router.navigate(['']);
      },
      (error) => {
        this.emailError = []
        this.nameError = []
        this.passwordError = []
        if(error.error.email){
          error.error.email.forEach((error: string) => {
              this.emailError?.push(error)
          });
          this.isEmailError = true;
        } else {
          this.isEmailError = false; // Asegúrate de restablecer el valor si no hay error
        }
  
        if(error.error.password){
          error.error.password.forEach((error: string) => {
            this.passwordError?.push(error)
        });
          this.isPasswordError = true;
        }

        if(error.error.password[0] == 'The password field confirmation does not match'){
          this.passwordError = null
          this.passwordConfirmationError = error.error.password[0];
          this.ispasswordConfirmationError = true
        }
  
        if(error.error.name){
          error.error.name.forEach((error: string) => {
            this.nameError?.push(error)
        });
          this.isNameError = true;
        }
      }
    );
  }

}
