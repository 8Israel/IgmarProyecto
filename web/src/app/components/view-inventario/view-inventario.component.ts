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
  public inventario: Inventario[] = []

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
        this.inventario[0] = response[0]

        console.log("INVENTARIO", this.inventario)
      }
    )
  }
}
