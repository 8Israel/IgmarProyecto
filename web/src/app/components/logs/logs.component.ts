import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../navbar/navbar.component';
import { LogsService } from '../../services/logs-service.service';
import { Logs } from '../../interfaces/logs';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-logs',
  standalone: true,
  imports: [NavbarComponent, FormsModule, CommonModule],
  templateUrl: './logs.component.html',
  styleUrl: './logs.component.css'
})
export class LogsComponent implements OnInit {

  constructor(private ls: LogsService) { }
  public logs: Logs[] = []

  public log: string = ""
  ngOnInit(): void {
    this.ls.getLogs().subscribe(
      (response) => {
        console.log(response[0])
        this.logs = response
      }
    )
  }

}
