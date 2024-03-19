import { Component } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-nuevo-formulario-mision',
  standalone: true,
  imports: [NavbarComponent],
  templateUrl: './nuevo-formulario-mision.component.html',
  styleUrl: './nuevo-formulario-mision.component.css'
})
export class NuevoFormularioMisionComponent {
  nombre!: string;
  tipo!: string;
  recompensaId: number = 0; 

  constructor(private title: Title) {
    this.title.setTitle("Agregar Mision")
  }

  guardarMision() {
    
    const nuevaMision = {
      nombre: this.nombre,
      tipo: this.tipo,
      recompensas_id: this.recompensaId
    };
    console.log('Datos de la nueva misión:', nuevaMision);
  }
}
