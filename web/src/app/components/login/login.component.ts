import { Component } from '@angular/core';
import { Router, RouterModule, RouterOutlet } from '@angular/router';
import { LoginService } from '../../services/login.service';
import { Login } from '../../interfaces/login';
import { FormBuilder, FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { User } from '../../interfaces/user';
import { Title } from '@angular/platform-browser';
import { UserService } from '../../services/user.service';
import { CommonModule } from '@angular/common';

import {LoadingSpinnerComponent} from '../loading-spinner/loading-spinner.component';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [RouterOutlet, RouterModule, FormsModule, CommonModule, ReactiveFormsModule, LoadingSpinnerComponent],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {

  constructor(private title: Title, private ls: LoginService, private router: Router, private us: UserService) { 
    this.title.setTitle("Iniciar sesión")
  }

  public errorMessage: string|null = null;
  public login: Login = {
    msg: "",
    token: ""
  }
  public isLoading: boolean = false;

  formGroup = new FormGroup({
    email: new FormControl('', [Validators.required, Validators.email]),
    password: new FormControl('', [Validators.required, Validators.minLength(8)])
  })

  get email(){
    return this.formGroup.get('email') as FormControl
  }

  get password() {
    return this.formGroup.get('password') as FormControl
  }
  onSubmit(event: Event) {
    event.preventDefault();
    this.isLoading = true;

    this.ls.LogIn(this.email.value, this.password.value).subscribe(
      (response) => {
        console.log(response)
        this.login.msg = response.msg
        this.login.token = response.token
        
        localStorage.setItem('token', response.token)

        this.router.navigate(['verificar'])
        this.isLoading = false;

      },
      (error) => {
        
        this.errorMessage = error.msg || error.message
        this.isLoading = false;
      }
    )
  } 



}
