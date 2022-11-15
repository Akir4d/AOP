import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { environment } from './../environments/environment';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  api = environment.api;
  title = 'primeng-sandbox';
  constructor(private router: Router ) {
    console.log(router.url);
  }
}
