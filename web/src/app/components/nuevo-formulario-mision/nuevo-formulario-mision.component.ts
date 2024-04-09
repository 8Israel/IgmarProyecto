import { Component, OnDestroy, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { Title } from '@angular/platform-browser';
import { ActivatedRoute, Router } from '@angular/router';
import { MisionesService } from '../../services/misiones.service';
import { Misiones } from '../../interfaces/misiones-recompensas';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Recompensas } from '../../interfaces/recompensas';
import { RecompensasService } from '../../services/recompensas.service';
import { CreateMision } from '../../interfaces/create-mision';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
(window as any).Pusher = Pusher

@Component({
  selector: 'app-nuevo-formulario-mision',
  standalone: true,
  imports: [NavbarComponent, CommonModule, FormsModule],
  templateUrl: './nuevo-formulario-mision.component.html',
  styleUrl: './nuevo-formulario-mision.component.css'
})
export class NuevoFormularioMisionComponent implements OnInit, OnDestroy {
  public misiones: Misiones[] = [];
  recompensaId: number = 0; 
  public mision_id: number = 0;
  public message: string|null = null
  public titulo: string = ""
  public updateMessage: string|null = null
  public redirectMessage: string|null = null

  echo: Echo = new Echo({
    broadcaster:'pusher',
    key:'123',
    cluster:'mt1',
    wsHost:'127.0.0.1',
    wsPort:6001,
    forceTLS:false,
    disableStatus:true,
  })

  constructor(private route: ActivatedRoute, private router: Router, private ms: MisionesService, private rs: RecompensasService) { }
  public mision: Misiones = {
    id: 0, 
    nombre: "", 
    tipo: "",
    recompensa_id: 0,
    recompensa: {
      id: 0,
      tipo: "",
      xp: 0 
    },
  }
  public createMision: CreateMision = {
    id: 0,
    nombre: "",
    tipo: "",
    recompensas_id: 0,
  }
  public recompensas: Recompensas[] = []

  websocket() {
    this.echo.channel('nuevaMision').listen('NuevaMision', (res: any) => {
      console.log(res)
      this.misiones.push(res.mision);
  });
  console.log(this.echo)
  this.echo.connect()
  }


  ngOnInit(): void {
    const params = this.route.snapshot.params;
    if (params['id']) {
      this.mision_id = + params['id']; 
      this.ms.getMisionById(this.mision_id).subscribe(
        (response) => {
          this.createMision.id = response[0].id
          this.createMision.nombre = response[0].nombre
          this.createMision.tipo = response[0].tipo
          this.createMision.recompensas_id = response[0].recompensa.id

          this.titulo = "Editar " + response[0].nombre
          
        }, (error) => {
          this.message = error.error
        }
        )
      }
      else{
        this.titulo = "Crear Mision"
      }
      this.rs.getRecompensas().subscribe(
        (response) => {
          this.recompensas = response
        }
      )
  }


  onSubmit() {
    this.websocket()
    const params = this.route.snapshot.params;
    if (params['id']) {
      this.ms.updateMisiones(this.createMision).subscribe(
        (response) => {
          this.updateMessage = "Mision editada con exito"
          this.redirectMessage = "Redireccionando a la lista de armas"
          setTimeout(() => {
            this.router.navigate(['/ver-misiones'])
          }, 2000)
        }
      )
    }
    else {
      this.ms.createMisiones(this.createMision).subscribe(
        (response) => {
          this.updateMessage = "Mision creada con exito"
          this.redirectMessage = "Redireccionando a la lista de misiones"
          setTimeout(() => {
            this.router.navigate(['/ver-misiones'])
          }, 2000)
        },
        (error) => {
          console.log(error)
        }
      )
    }
  }

  ngOnDestroy(): void {
    this.echo.disconnect()
  }
}
