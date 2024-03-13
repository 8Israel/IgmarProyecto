import { Component } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { Router, RouterModule } from '@angular/router';
import { User } from '../../interfaces/user';
import { LoginService } from '../../services/login.service';
import { FormsModule } from '@angular/forms';
import { UserService } from '../../services/user.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-verficar-login',
  standalone: true,
  imports: [RouterModule, FormsModule, CommonModule],
  templateUrl: './verficar-login.component.html',
  styleUrl: './verficar-login.component.css'
})
export class VerficarLoginComponent {

  constructor(private router: Router, private title: Title, private ls: LoginService, private us: UserService) { 
    this.title.setTitle('Verificacion')
  }
  public message: string|null = null
  codigo: Number = 0
  public user: User = {
    data: {
      id: 0,
      name: "",
      email: "",
      role_id: 0
    },
    token: ""
  }

  user_id: Number = 0
  onSubmit(codigo: string) {
    const codigoEntero: number = parseInt(codigo);

    this.ls.VerificarCodigo(codigoEntero).subscribe(
        (response) => {
            console.log(response);
            this.user.data.id = response.data.id;
            this.user.data.name = response.data.name;
            this.user.data.email = response.data.email;
            this.user.data.role_id = response.data.role_id;
            this.user.token = response.token;
            this.user_id = response.data.id;

            this.us.setUser(this.user);
            localStorage.setItem('token', response.token)
            

        },
        (error) => {
          this.message = error.message
        }
    );
}

}
