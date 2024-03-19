import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms'; // Importa FormsModule
import { CommonModule } from '@angular/common'; // Importa CommonModule
import { InventarioService } from '../../services/inventario.service';
import { Router } from '@angular/router';
import { Armas } from '../../interfaces/armas';
import { Heroes } from '../../interfaces/heroes';
import { ArmasService } from '../../services/armas.service';
import { HeroesService } from '../../services/heroes.service';

@Component({
  selector: 'app-form-inventario',
  standalone: true,
  imports: [FormsModule, CommonModule], // Añade FormsModule y CommonModule aquí
  templateUrl: './form-inventario.component.html',
  styleUrls: ['./form-inventario.component.css']
})
export class FormInventarioComponent implements OnInit {
  armas_id: number | undefined;
  heroes_id: number | undefined;
  armas: Armas[] = [];
  heroes: Heroes[] = [];

  constructor(
    private is: InventarioService,
    private router: Router,
    private as: ArmasService,
    private hs: HeroesService
  ) { }

  ngOnInit(): void {
    this.as.getArmas().subscribe(
      (response) => {
        this.armas = response;
        console.log(this.armas);
      }
    );

    this.hs.getHeroes().subscribe(
      (response) => {
        this.heroes = response;
        console.log(this.heroes);
      }
    );
  }

  EditarInventario() {
    if (this.armas_id !== undefined && this.heroes_id !== undefined) {
      this.is.putInventario(this.armas_id, this.heroes_id).subscribe(
        (response) => {
          console.log(response);
        }
      );
    } else {
      console.error('Error: armas_id o heroes_id son undefined');
    }
  }
}
