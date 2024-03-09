import { Component } from '@angular/core';
import { RouterModule, RouterOutlet } from '@angular/router';
import { LoginService } from '../../services/login.service';
import { Login } from '../../interfaces/login';
import { FormsModule } from '@angular/forms';
import { User } from '../../interfaces/user';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [RouterOutlet, RouterModule, FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {

  constructor(private ls: LoginService) { }

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

        localStorage.setItem('token', response.token)

      }
    )
  } 

}
