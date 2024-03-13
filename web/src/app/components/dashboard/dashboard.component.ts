import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { Title } from '@angular/platform-browser';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { Player } from '../../interfaces/player';
import { MisionesService } from '../../services/misiones.service';
import { Misiones } from '../../interfaces/misiones';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [NavbarComponent, FormsModule, CommonModule],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent implements OnInit {

  constructor(private title: Title, private us: UserService, private ms: MisionesService) {
    this.title.setTitle("Dashboard")
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
  public jugador: Player = {
    id: 0,
    nombre: "",
    experiencia: 0,
    nivel: 0,
    puntuacion: 0,
    user_id: 0
  }
  public misiones: Misiones[] = []

  ngOnInit(): void {
    this.user = this.us.getUser()

    this.ms.getMisiones().subscribe(
      (response: Misiones[]) => {
        this.misiones.push(...response)
      }
    )
    console.log(this.misiones)
  }



}
