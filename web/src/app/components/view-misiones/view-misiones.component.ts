import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-view-misiones',
  standalone: true,
  imports: [NavbarComponent, CommonModule],
  templateUrl: './view-misiones.component.html',
  styleUrl: './view-misiones.component.css'
})
export class ViewMisionesComponent implements OnInit {


  constructor (private us: UserService) { }

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
  }
}
