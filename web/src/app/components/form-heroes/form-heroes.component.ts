import { Component } from '@angular/core';

@Component({
  selector: 'app-form-heroes',
  templateUrl: './form-heroes.component.html',
  standalone: true,
  imports: [],
  styleUrl: './form-heroes.component.css'
})
export class FormHeroesComponent {
  nombre!: string;
  tipo!: string;
  rareza!: string;
  habilidadEspecial!: string;

  constructor() { }

  guardarHeroe() {
    const nuevoHeroe = {
      nombre: this.nombre,
      tipo: this.tipo,
      rareza: this.rareza,
      habilidad_especial: this.habilidadEspecial
    };
    console.log('Datos del héroe:', nuevoHeroe);
    
  }
}
