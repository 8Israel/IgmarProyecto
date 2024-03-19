import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { UserService } from '../../services/user.service';
import { User } from '../../interfaces/user';
import { CommonModule } from '@angular/common';
import { ArmasService } from '../../services/armas.service';
import { Armas } from '../../interfaces/armas';
import { RouterLink } from '@angular/router';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-view-armas',
  standalone: true,
  imports: [NavbarComponent, CommonModule, RouterLink],
  templateUrl: './view-armas.component.html',
  styleUrl: './view-armas.component.css'
})
export class ViewArmasComponent implements OnInit {

  constructor(public us: UserService, private as: ArmasService, private title: Title) { 
    this.title.setTitle('Armas')
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
  selectedArma: Armas = { id: 0, nombre: '', tipo: '', rareza: '', danio_base: 0 };

  public armas: Armas[] = []

  ngOnInit(): void {
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
  }

  deleteWeapon(id: Number) {
    this.as.deleteArma(id).subscribe(
      (response) => {
        this.message = "Arma eliminada con exito"
        this.armas = this.armas.filter(arma => arma.id !== this.selectedArma.id);
      }
    )
  }

}
