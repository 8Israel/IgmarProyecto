import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { ActivatedRoute, Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { UserData } from '../../interfaces/user-data';
import { UsersResponse } from '../../interfaces/users-response';
import { UserById } from '../../interfaces/user-by-id';
import { Roles } from '../../interfaces/roles';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { UserUpdate } from '../../interfaces/user-update';

@Component({
  selector: 'app-editar-usuario',
  standalone: true,
  imports: [NavbarComponent, CommonModule, FormsModule],
  templateUrl: './editar-usuario.component.html',
  styleUrl: './editar-usuario.component.css'
})
export class EditarUsuarioComponent implements OnInit {

  constructor(private route: ActivatedRoute, private us: UserService, private router: Router) { }

  private user_id: Number = 0


  public user: UserById = {
    message: "",
    users: {
      id: 0,
      name: "",
      email: "",
      role_id: 0,
      activate: false
    }
  };

  public userUpdate: UserUpdate = {
    email: "",
    name: "",
    role_id: 0
  }

  public roles: Roles[] = []
  
  ngOnInit(): void {
    this.route.params.subscribe(
      (params) => {
        this.user_id = params['id']
      }
    )
    
    this.us.getUserById(this.user_id).subscribe(
      (response) => {
        this.user.users = response.users
      }
    )

    this.us.getRoles().subscribe(
      (response: Roles[]) => {
        this.roles = response
        console.log("RESPONSE ROLES", this.roles)
      }
    )

  }

  onSubmit() {
    this.us.editUser(this.userUpdate, this.user_id).subscribe(
      (response) => {
        this.router.navigate(['ver-jugadores'])
      }
    ) 
  }

}
