import { Component } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { HeroeResponse } from '../../interfaces/heroe-response';
import { HeroesService } from '../../services/heroes.service';
import { Heroes } from '../../interfaces/heroes';

@Component({
  selector: 'app-view-heroes',
  standalone: true,
  imports: [ FormsModule, CommonModule, NavbarComponent, RouterLink],
  templateUrl: './view-heroes.component.html',
  styleUrls: ['./view-heroes.component.css']
})
export class ViewHeroesComponent {

  public heroes: Heroes[] = [];

  constructor(private heroesService: HeroesService) { }

  ngOnInit() {
    this.heroesService.getHeroes().subscribe(
      (response) => {
        this.heroes = response;
        console.log(this.heroes);
      }
    );
  }

}
