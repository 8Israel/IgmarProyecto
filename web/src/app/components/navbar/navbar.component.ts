import { Component, Input, OnInit } from '@angular/core';
import { RouterModule } from '@angular/router';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [RouterModule, CommonModule],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css'
})
export class NavbarComponent implements OnInit {

  constructor(private us: UserService) { }

  @Input() titulo: string = ""

  user: User = {
    data: {
      email: '',
      id:0,
      name: '',
      role_id: 0,
    },
    token: ''
  }

  ngOnInit(): void {
    this.us.getUserData().subscribe(
      (response) => {
        this.user.data.id = response.id
        this.user.data.email = response.email
        this.user.data.name = response.name
        this.user.data.role_id = response.role_id
      }
    )
  }

}
