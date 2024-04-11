import { Component } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { HeroeResponse } from '../../interfaces/heroe-response';
import { HeroesService } from '../../services/heroes.service';
import { Heroes } from '../../interfaces/heroes';
import { User } from '../../interfaces/user';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-view-heroes',
  standalone: true,
  imports: [ FormsModule, CommonModule, NavbarComponent, RouterLink],
  templateUrl: './view-heroes.component.html',
  styleUrls: ['./view-heroes.component.css']
})
export class ViewHeroesComponent {

  public heroes: Heroes[] = [];

  public user: User = {
    data: {
      id: 0,
      name: "",
      email: "",
      role_id: 0
    },
    token: ""
  }

  constructor(private heroesService: HeroesService, private us: UserService) { }

  ngOnInit() {
    this.us.getUserData().subscribe(
      (response) => {
        this.user.data.email = response.email
        this.user.data.id = response.id
        this.user.data.name = response.name
        this.user.data.role_id = response.role_id
      }
    )
    this.heroesService.getHeroes().subscribe(
      (response) => {
        this.heroes = response;
        console.log(this.heroes);
      }
    );
  }

}
