import { Component } from '@angular/core';

@Component({
  selector: 'app-form-armas',
  standalone: true,
  imports: [],
  templateUrl: './form-armas.component.html',
  styleUrl: './form-armas.component.css'
})
export class FormArmasComponent {
  nombre!: string;
  tipo!: string;
  rareza!: string;
  danioBase!: number;

  constructor() { }

  guardarArma() {
    const nuevaArma = {
      nombre: this.nombre,
      tipo: this.tipo,
      rareza: this.rareza,
      danio_base: this.danioBase
    };
    console.log('Datos del arma:', nuevaArma);
    // Aquí puedes realizar una solicitud HTTP para guardar el arma utilizando Angular HttpClient
  }
}
