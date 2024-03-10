import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { Title } from '@angular/platform-browser';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [NavbarComponent],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent implements OnInit {

  constructor(private title: Title, private us: UserService) {
    this.title.setTitle("Dashboard")
  }
  public user: User|null = {
    data: {
      id: 0,
      name: "",
      email: "",
    },
    token: ""
  }

  ngOnInit(): void {
    this.user = this.us.getUser()

    


  }


}
