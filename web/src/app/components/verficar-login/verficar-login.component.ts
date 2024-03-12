import { Component } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { Router, RouterModule } from '@angular/router';
import { User } from '../../interfaces/user';
import { LoginService } from '../../services/login.service';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-verficar-login',
  standalone: true,
  imports: [RouterModule, FormsModule],
  templateUrl: './verficar-login.component.html',
  styleUrl: './verficar-login.component.css'
})
export class VerficarLoginComponent {

  constructor(private router: Router, private title: Title, private ls: LoginService) { 
    this.title.setTitle('Verificacion')
  }
  codigo: Number = 0
  public user: User = {
    data: {
      id: 0,
      name: "",
      email: ""
    },
    token: ""
  }

  onSubmit(codigo: string) {

    const codigoEntero: Number = parseInt(codigo)
    this.ls.VerificarCodigo(codigoEntero).subscribe(
      (response) => {
        console.log(response)
      }
    )
  } 

}
