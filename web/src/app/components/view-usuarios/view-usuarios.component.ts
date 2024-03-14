import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { User } from '../../interfaces/user';
import { UserService } from '../../services/user.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-view-usuarios',
  standalone: true,
  imports: [NavbarComponent, CommonModule],
  templateUrl: './view-usuarios.component.html',
  styleUrl: './view-usuarios.component.css'
})
export class ViewUsuariosComponent implements OnInit {

  constructor (private us: UserService) { }

  public user: User = {
    data: {
      id: 0,
      email: "",
      name: "",
      role_id: 0
    },
    token: "",
  }

  public titulo: string = ""

  ngOnInit(): void {
    this.user = this.us.getUser()

    if(this.user.data.role_id == 2){
      this.titulo = "Agregar amigos"
    }
    else if (this.user.data.role_id == 1){
      this.titulo = "Usuarios"
    }
  }

}
