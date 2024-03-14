import { Component } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-view-recompensas',
  standalone: true,
  imports: [NavbarComponent, RouterModule],
  templateUrl: './view-recompensas.component.html',
  styleUrl: './view-recompensas.component.css'
})
export class ViewRecompensasComponent {

}
