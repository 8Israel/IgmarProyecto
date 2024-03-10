import { Component } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [NavbarComponent],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent {

  constructor(private title: Title) {
    this.title.setTitle("Dashboard")
  }
}
