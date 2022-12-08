import { Component, OnChanges, Output, SimpleChanges, OnInit } from '@angular/core';
import { MessagesJs, User } from '@app/_modules/dtos';
import { AccountService } from '@app/_modules/services';
import { MessageService } from 'primeng/api';

@Component({
  selector: 'app-console',
  templateUrl: './console.component.html',
  styleUrls: ['./console.component.scss'],
  providers: [MessageService]
})
export class ConsoleComponent implements OnChanges, OnInit {
  user?: User | null;
  @Output() messages = [] as MessagesJs[];

  constructor(private accountService: AccountService, private messageService: MessageService) {
    this.messageService.clear();
    this.accountService.user.subscribe(x => this.user = x);
  }

  ngOnInit(): void {
    this.accountService.loginChecks().subscribe({
      next: e => {
        this.messages = e
      }
    });
  }

  ngOnChanges(changes: SimpleChanges): void {
    this.accountService.loginChecks().subscribe({
      next: e => {
        this.messages = e
      }
    });
  }

  logout() {
    this.accountService.logout();
  }
}
