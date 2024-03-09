import { Component } from '@angular/core';
import { RouterModule, RouterOutlet } from '@angular/router';
import { RegisterService } from '../../services/register.service';
import { Register } from '../../interfaces/register';
import { FormsModule } from '@angular/forms';
import { User } from '../../interfaces/user';
import { LoginService } from '../../services/login.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [RouterOutlet, RouterModule, FormsModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent {

  constructor(private rs: RegisterService, private ls: LoginService) { }

  message: string|null = null;

  public register: Register = {
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
  }
  
  onSubmit(event: Event) {
    event.preventDefault()

    this.rs.Register(this.register).subscribe(
      (response) => {
        console.log(response)
      }
    )
  }

}
