import { Component } from '@angular/core';

@Component({
  selector: 'app-form-inventario',
  standalone: true,
  imports: [],
  templateUrl: './form-inventario.component.html',
  styleUrl: './form-inventario.component.css'
})
export class FormInventarioComponent {
  userId!: number;
  armasId!: number;
  heroesId!: number;

  constructor() { }

  guardarInventario() {
    const nuevoInventario = {
      user_id: this.userId,
      armas_id: this.armasId,
      heroes_id: this.heroesId
    };
    console.log('Datos del inventario:', nuevoInventario);
    // Aquí puedes realizar una solicitud HTTP para guardar el inventario utilizando Angular HttpClient
  }
}
