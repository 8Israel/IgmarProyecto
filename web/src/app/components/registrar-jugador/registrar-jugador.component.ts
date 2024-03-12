import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { PlayerService } from '../../services/player.service';
import { Player } from '../../interfaces/player';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-registrar-jugador',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './registrar-jugador.component.html',
  styleUrl: './registrar-jugador.component.css'
})
export class RegistrarJugadorComponent{

  constructor(private title: Title, private ps: PlayerService, private us: UserService){
    this.title.setTitle('Registro Jugador')
  }
  public player: Player = {
    id: 0,
    experiencia: 0,
    nivel: 0,
    nombre: "",
    puntuacion: 0,
    user_id: 0
  }

  user = this.us.getUser()
  public nombre = ""

  onSubmit() {
    this.ps.createPlayer(this.user.data.id, this.nombre).subscribe(
      (response) => {
        console.log(response)
      }
    )
  }

}
