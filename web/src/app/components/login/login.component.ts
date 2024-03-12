import { Component } from '@angular/core';
import { Router, RouterModule, RouterOutlet } from '@angular/router';
import { LoginService } from '../../services/login.service';
import { Login } from '../../interfaces/login';
import { FormsModule } from '@angular/forms';
import { User } from '../../interfaces/user';
import { Title } from '@angular/platform-browser';
import { UserService } from '../../services/user.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [RouterOutlet, RouterModule, FormsModule, CommonModule],
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
  email: string = ""
  password: string = ""

  onSubmit(event: Event) {
    event.preventDefault();

    this.ls.LogIn(this.email, this.password).subscribe(
      (response) => {
        console.log(response)
        this.login.msg = response.msg
        this.login.token = response.token
        
        localStorage.setItem('token', response.token)

        this.router.navigate(['verificar'])

      },
      (error) => {
        
        this.errorMessage = error.msg
      }
    )
  } 



}
