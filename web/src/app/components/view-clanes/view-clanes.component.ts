import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { ClanesService } from '../../services/clanes.service';
import { Clanes } from '../../interfaces/clanes';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';
import { User } from '../../interfaces/user';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-view-clanes',
  standalone: true,
  imports: [ FormsModule, NavbarComponent, CommonModule, RouterLink ],
  templateUrl: './view-clanes.component.html',
  styleUrl: './view-clanes.component.css'
})
export class ViewClanesComponent implements OnInit {

  constructor(private cs: ClanesService, private us: UserService) { }

  public clanes: Clanes[] = []
  public selectedClan: Clanes = {
    id: 0,
    activate: false,
    name: '',
    lider: 0,
    nivel_clan: 0,
    nombre: ''
  }
  public user: User = {
    data: {
      id: 0,
      name: "",
      email: "",
      role_id: 0
    },
    token: ""
  }

  ngOnInit(): void {
    this.us.getUserData().subscribe(
      (response) => {
        this.user.data.id = response.id
        this.user.data.name = response.name
        this.user.data.email = response.email
        this.user.data.role_id = response.role_id
      }
    )
    this.cs.serverClanes().subscribe(
      (response) => {
        this.clanes = response
        console.log(response)
      }
    )
  }

  deleteClan(id: Number){
    this.cs.deleteClan(id).subscribe(
      (response) => {

      },
      (error) => {
        
      }
    )
  }

}
