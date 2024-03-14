import { Component } from '@angular/core';

@Component({
  selector: 'app-nuevo-formulario-mision',
  standalone: true,
  imports: [],
  templateUrl: './nuevo-formulario-mision.component.html',
  styleUrl: './nuevo-formulario-mision.component.css'
})
export class NuevoFormularioMisionComponent {
  nombre!: string;
  tipo!: string;
  recompensaId: number = 0; 
  constructor() { }

  guardarMision() {
    
    const nuevaMision = {
      nombre: this.nombre,
      tipo: this.tipo,
      recompensas_id: this.recompensaId
    };
    console.log('Datos de la nueva misión:', nuevaMision);
   
  }
}
