import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { Title } from '@angular/platform-browser';
import { MisionesService } from '../../services/misiones.service';
import { Misiones } from '../../interfaces/misiones-recompensas';

@Component({
  selector: 'app-view-misiones',
  standalone: true,
  imports: [NavbarComponent, CommonModule, RouterLink],
  templateUrl: './view-misiones.component.html',
  styleUrl: './view-misiones.component.css'
})
export class ViewMisionesComponent implements OnInit {


  constructor (private us: UserService, private title: Title, private ms: MisionesService) { 
    this.title.setTitle("Misiones")
  }

  public message: string|null = null
  public user: User = {
    data: {
      id: 0,
      name: "",
      email: "",
      role_id: 0
    },
    token: ""
  }
  selectedMision: Misiones = {
    id: 0,
    nombre: "",
    recompensa_id: 0,
    tipo: "",
    recompensa: {
      id: 0,
      tipo: "",
      xp: 0
    },
  }
  public misiones: Misiones[] = []

  ngOnInit(): void {
    this.us.getUserData().subscribe(
      (response) => {
        this.user.data.id = response.id
        this.user.data.name = response.name
        this.user.data.email = response.email
        this.user.data.role_id = response.role_id
      }
    )
    this.ms.getMisiones().subscribe(
      (response) => {
        this.misiones = response; // Limitando a las primeras 3 misiones
        console.log("RESPONSE MISIONES", this.misiones);
      }
    );
  }

  deleteWeapon(id: Number) {
    this.ms.deleteMisiones(id).subscribe(
      (response) => {
        this.message = "Arma eliminada con exito"
        this.misiones = this.misiones.filter(mision => mision.id !== this.selectedMision.id);
      }
    )
  }
}
