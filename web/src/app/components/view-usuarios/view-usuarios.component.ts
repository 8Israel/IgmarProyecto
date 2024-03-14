import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { User } from '../../interfaces/user';
import { UserService } from '../../services/user.service';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { UserData } from '../../interfaces/user-data';
import { UsersResponse } from '../../interfaces/users-response';

@Component({
  selector: 'app-view-usuarios',
  standalone: true,
  imports: [NavbarComponent, CommonModule, RouterModule],
  templateUrl: './view-usuarios.component.html',
  styleUrl: './view-usuarios.component.css'
})
export class ViewUsuariosComponent implements OnInit {

  constructor (private us: UserService) { }

  public deleteMessage: string|null = null
  public user: User = {
    data: {
      id: 0,
      email: "",
      name: "",
      role_id: 0
    },
    token: "",
  }

  public users: UserData[] = []

  public titulo: string = ""

  ngOnInit(): void {
    this.user = this.us.getUser()

    if(this.user.data.role_id == 2){
      this.titulo = "Agregar amigos"
    }
    else if (this.user.data.role_id == 1){
      this.titulo = "Usuarios"
    }

    this.us.getUsers().subscribe(
      (response: UsersResponse) => {
        console.log("RESPONSE USERS",response);
          this.users = response.users
      },
      (error) => {
        console.error('Error al obtener usuarios:', error);
      }
    );
  }

  deleteUser(user_id: number): void {
    this.deleteMessage = null
    this.us.deleteUser(user_id).subscribe(
      (response) => {
        console.log(response);
        this.deleteMessage = "Usuario eliminado con éxito";
        
        // Una vez eliminado el usuario, actualiza la lista de usuarios
        // Puedes llamar a la función que obtiene la lista de usuarios nuevamente
        // o simplemente eliminar el usuario de la lista actual si ya la tienes en tu componente.
        // Por ejemplo, si tienes un arreglo llamado users que contiene todos los usuarios:
        this.users = this.users.filter(user => user.id !== user_id);
      },
      (error) => {
        console.error(error);
        // Manejar errores aquí si es necesario
      }
    );
  }

}
