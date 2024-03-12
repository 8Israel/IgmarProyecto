import { Component } from '@angular/core';
import { Router, RouterModule, RouterOutlet } from '@angular/router';
import { LoginService } from '../../services/login.service';
import { Login } from '../../interfaces/login';
import { FormsModule } from '@angular/forms';
import { User } from '../../interfaces/user';
import { Title } from '@angular/platform-browser';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [RouterOutlet, RouterModule, FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {

  constructor(private title: Title, private ls: LoginService, private router: Router, private us: UserService) { 
    this.title.setTitle("Iniciar sesión")
  }

  public message: string|null = null;
  public login: Login = {
    email: "",
    password: ""
  }
  public user: User = {
    data: {
      id: 0,
      name: "",
      email: ""
    },
    token: ""
  }

  onSubmit(event: Event) {
    event.preventDefault();

    this.ls.LogIn(this.login).subscribe(
      (response) => {
        console.log(response)
        this.user.data.name = response.data.name
        this.user.data.email = response.data.email
        this.user.data.id = response.data.id
        this.user.token = response.token

        this.us.setUser(this.user)

        localStorage.setItem('token', response.token)

        this.router.navigate(['verificar'])

      },
      (error) => {
        this.message = error.msg
      }
    )
  } 



}
