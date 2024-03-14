import { Component } from '@angular/core';

@Component({
  selector: 'app-form-clanes',
  standalone: true,
  imports: [],
  templateUrl: './form-clanes.component.html',
  styleUrl: './form-clanes.component.css'
})
export class FormClanesComponent {
  lider!: number;
  nombre!: string;
  nivelClan!: number;
  activate: boolean = true;

  constructor() { }

  guardarClan() {
    const nuevoClan = {
      lider: this.lider,
      nombre: this.nombre,
      nivel_clan: this.nivelClan,
      activate: this.activate
    };
    console.log('Datos del clan:', nuevoClan);
    // Aquí puedes realizar una solicitud HTTP para guardar el clan utilizando Angular HttpClient
  }
}
