import { Component, OnInit } from '@angular/core';
import { RouterModule } from '@angular/router';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [RouterModule],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css'
})
export class NavbarComponent implements OnInit {

  constructor(private us: UserService) { }

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
    
  }

}
