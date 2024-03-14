import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { Title } from '@angular/platform-browser';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { Player } from '../../interfaces/player';
import { MisionesService } from '../../services/misiones.service';
import { Misiones } from '../../interfaces/misiones-recompensas';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { take } from 'rxjs/operators';
import { HeroesService } from '../../services/heroes.service';
import { Heroes } from '../../interfaces/heroes';
import { RouterModule } from '@angular/router';
import { UserData } from '../../interfaces/user-data';
import { FriendsService } from '../../services/friends.service';
import { Friend } from '../../interfaces/friend';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [NavbarComponent, FormsModule, CommonModule, RouterModule],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent implements OnInit {

  constructor(private title: Title, private us: UserService, private ms: MisionesService, private hs: HeroesService, private fs: FriendsService) {
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
  public heroes: Heroes[] = []
  public amigos: Friend[] = []

  ngOnInit(): void {
    this.user = this.us.getUser()

    console.log(this.us.getUser())

    this.ms.getMisiones().subscribe(
      (response) => {
        console.log("RESPONSE MISIONES", response);
        this.misiones.push(...response.slice(0, 3)); // Limitando a las primeras 3 misiones
      }
    );
    if(this.user.data.role_id == 2){
      this.fs.getFriends().subscribe(
        (response) => {
          console.log("RESPONSE FRIENDS", response)
          this.amigos.push(...response.slice(0,3))
        }
      )
    }

    this.hs.getHeroes().subscribe(
      (response) => {
        console.log("RESPONSE HEROES", response)
        this.heroes.push(...response.slice(0,3));
      }
    )
    // console.log(this.misiones)
  }



}
