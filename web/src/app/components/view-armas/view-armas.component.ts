import { Component, OnDestroy, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { CommonModule } from '@angular/common';
import { ArmasService } from '../../services/armas.service';
import { Armas } from '../../interfaces/armas';
import { Router, RouterLink } from '@angular/router';
import { Title } from '@angular/platform-browser';
import { InventarioService } from '../../services/inventario.service';
import { Inventario } from '../../interfaces/inventario';
import { Editinventario } from '../../interfaces/edit-inventario';
import { Subscription, interval, switchMap } from 'rxjs';

@Component({
  selector: 'app-view-armas',
  standalone: true,
  imports: [NavbarComponent, CommonModule, RouterLink],
  templateUrl: './view-armas.component.html',
  styleUrl: './view-armas.component.css'
})
export class ViewArmasComponent implements OnInit, OnDestroy {
  arma_id: Number = 0
  constructor(public us: UserService, private as: ArmasService, private title: Title, private is: InventarioService, private router: Router) { 
    this.title.setTitle('Armas')
  }

  private pollingSubscription: Subscription = new Subscription();
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
  public inventario: Inventario = {
    user: 0,
    arma: {
      id: 0,
      nombre: "",
      danio_base: 0,
      rareza: "",
      tipo: ""
    },
    heroe: {
      id: 0,
      nombre: "",
      habilidad_especial: "",
      rareza: "",
      tipo: ""
    }
  }
  public editInventario: string|null = null
  
  selectedArma: Armas = { id: 0, nombre: '', tipo: '', rareza: '', danio_base: 0 };

  public armas: Armas[] = []

  ngOnInit(): void {

    const pollingInterval = 5000
    this.pollingSubscription = interval(pollingInterval).pipe(
      switchMap(() => this.as.getArmas())
    ).subscribe(
      (response) => {
        console.log(response)
        this.armas = response
      }
    )

    this.us.getUserData().subscribe(
      (response) => {
        this.user.data.id = response.id
        this.user.data.name = response.name
        this.user.data.email = response.email
        this.user.data.role_id = response.role_id
      }
    )
    this.as.getArmas().subscribe(
      (response) => {
        this.armas = response
      }
    )
    this.is.getInventarioById(this.user.data.id).subscribe(
      (response) => {
        this.inventario.heroe.id = response.heroe.id

        console.log(this.inventario)
      }
    )
  }

  ngOnDestroy(): void {
    if (this.pollingSubscription) {
      this.pollingSubscription.unsubscribe();
    }
  }

  deleteWeapon(id: Number) {
    this.as.deleteArma(id).subscribe(
      (response) => {
        this.message = "Arma eliminada con exito"
      }
    )
  }

  addWeapon(arma_id: Number){
    console.log(arma_id)
    this.is.putInventario(arma_id, this.inventario.heroe.id).subscribe(
      (response) => {
        this.editInventario = response.message

        setTimeout(() => {
          this.router.navigate(['ver-inventario']);
        }, 1500)
      }
    )
  }



}
