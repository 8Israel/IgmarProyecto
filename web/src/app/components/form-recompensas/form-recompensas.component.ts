import { Component } from '@angular/core';
import { RecompensasService } from '../../services/recompensas.service';
import { Recompensas } from '../../interfaces/recompensas';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-form-recompensas',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './form-recompensas.component.html',
  styleUrl: './form-recompensas.component.css'
})
export class FormRecompensasComponent {
 public recompensa:Recompensas={
  id: 0,
  tipo: '',
  xp: 0
 }

  constructor(private rs:RecompensasService, private router: Router) { }

  guardarRecompensa() {
   this.rs.createRecompensas(this.recompensa).subscribe(
    (response)=>{

        console.log(response);
        this.router.navigate(['/ver-recompensas'])
    }
   )
    
    // Aquí puedes realizar una solicitud HTTP para guardar la recompensa utilizando Angular HttpClient
  }
}
