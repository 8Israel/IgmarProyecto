import { Component, OnInit } from '@angular/core';
import { RecompensasService } from '../../services/recompensas.service';
import { Recompensas } from '../../interfaces/recompensas';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ignoreElements } from 'rxjs';

@Component({
  selector: 'app-form-recompensas',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './form-recompensas.component.html',
  styleUrl: './form-recompensas.component.css'
})
export class FormRecompensasComponent implements OnInit {
 public recompensa:Recompensas={
  id: 0,
  tipo: '',
  xp: 0
 }

  constructor(private rs:RecompensasService, private router: Router, private route: ActivatedRoute) { }


  ngOnInit(): void {
    const params = this.route.snapshot.params
    if(params) {
    }
  }

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
