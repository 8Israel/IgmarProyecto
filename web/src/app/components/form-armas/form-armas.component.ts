import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ArmasService } from '../../services/armas.service';
import { Armas } from '../../interfaces/armas';
import { NavbarComponent } from '../navbar/navbar.component';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-form-armas',
  standalone: true,
  imports: [NavbarComponent, FormsModule, CommonModule],
  templateUrl: './form-armas.component.html',
  styleUrl: './form-armas.component.css'
})
export class FormArmasComponent implements OnInit {
  
  public message: string|null = null
  public titulo: string = ""
  public updateMessage: string|null = null
  public redirectMessage: string|null = null
  arma_id: number = 0;
  public arma: Armas = {
    id: 0,
    nombre: "",
    tipo: "",
    
    rareza: "",
    danio_base: 0,
  }

  constructor(private route: ActivatedRoute, private router: Router, private as: ArmasService) { }

  ngOnInit(): void {
    const params = this.route.snapshot.params;
    if (params['id']) {
      this.arma_id = +params['id']; 
      this.as.getArmasById(this.arma_id).subscribe(
        (response) => {
          this.titulo = "Editar " + response.nombre
          this.arma.id = response.id;
          this.arma.nombre = response.nombre;
          this.arma.tipo = response.tipo;
          this.arma.rareza = response.rareza
          this.arma.danio_base = response.danio_base
        },
        (error) => {
          this.message = error.error
        }
      )
    }
    else{
      this.titulo = "Crear arma"
    }
  }

  onSubmit() {
    const params = this.route.snapshot.params;
    if (params['id']) {
      this.as.updateArma(this.arma).subscribe(
        (response) => {
          console.log(response)
          this.updateMessage = "Arma actualizada correctamente"
          this.redirectMessage = "Redireccionando a la lista de armas"
          setTimeout(() => {
            this.router.navigate(['/ver-armas'])
          }, 2000)
        },
        (error) => {
          this.message = error.error
        }
      )
    }
    else {
      this.as.createArma(this.arma).subscribe(
        (response) => {
          console.log(response)
          this.updateMessage = "Arma creada con exito"
          this.redirectMessage = "Redireccionando a la lista de armas"
          setTimeout(() => {
            this.router.navigate(['/ver-armas'])
          }, 2000)
        },
        (error) => {
          this.message = error.error
        }
      )
    }
  }
}
