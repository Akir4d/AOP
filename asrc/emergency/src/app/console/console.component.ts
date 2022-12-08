import { Component } from '@angular/core';
import { User } from '@app/_modules/dtos';
import { AccountService } from '@app/_modules/services';
import {MessageService} from 'primeng/api';

@Component({
  selector: 'app-console',
  templateUrl: './console.component.html',
  styleUrls: ['./console.component.scss'],
  providers: [MessageService]
})
export class ConsoleComponent {
  user?: User | null;

  constructor(private accountService: AccountService,private messageService: MessageService) {
    this.messageService.clear();
    this.accountService.user.subscribe(x => this.user = x);
  }
  logout() {
    this.accountService.logout();
  }
}
