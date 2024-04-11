import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { RouterModule } from '@angular/router';
import { InventarioService } from '../../services/inventario.service';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { Inventario } from '../../interfaces/inventario';

@Component({
  selector: 'app-view-inventario',
  standalone: true,
  imports: [NavbarComponent, RouterModule],
  templateUrl: './view-inventario.component.html',
  styleUrl: './view-inventario.component.css'
})
export class ViewInventarioComponent implements OnInit {

  constructor(private is: InventarioService, private us: UserService) { }

  public user: User = {
    data: {
      id: 0,
      email: "",
      name: "",
      role_id: 0
    },
    token: ""
  }
  public inventario: Inventario = {
    arma: {
      id: 0,
      danio_base: 0,
      nombre: "",
      rareza: "",
      tipo: "",
    },
    heroe: {
      id: 0,
      habilidad_especial: "",
      nombre: "",
      rareza: "",
      tipo: ""
    },
    user: 0
  }

  ngOnInit(): void {
    this.us.getUserData().subscribe(
      (response) => {
        this.user.data.id = response.id
        this.user.data.email = response.email
        this.user.data.name = response.name
        this.user.data.role_id = response.role_id
      }
    )
    this.is.getInventarioById(this.user.data.id).subscribe(
      (response) => {
        this.inventario.user = response.user
        this.inventario.arma.id = response.arma.id
        this.inventario.arma.danio_base = response.arma.danio_base
        this.inventario.arma.nombre = response.arma.nombre
        this.inventario.arma.rareza = response.arma.rareza
        this.inventario.arma.tipo = response.arma.tipo

        this.inventario.heroe.habilidad_especial = response.heroe.habilidad_especial
        this.inventario.heroe.id = response.heroe.id
        this.inventario.heroe.nombre = response.heroe.nombre
        this.inventario.heroe.rareza = response.heroe.rareza
        this.inventario.heroe.tipo = response.heroe.tipo

        console.log("INVENTARIO", this.inventario)
      }
    )
  }
}
