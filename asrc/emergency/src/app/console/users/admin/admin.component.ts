import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';

import { AccountService } from '@app/_services';

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
})
export class AdminComponent implements OnInit {

  form!: FormGroup;
  id?: string;
  title!: string;
  loading = false;
  submitting = false;
  submitted = false;

  constructor(
      private formBuilder: FormBuilder,
      private route: ActivatedRoute,
      private accountService: AccountService
  ) { }

  ngOnInit() {
      this.id = this.route.snapshot.params['id'];

      // form with validation rules
      this.form = this.formBuilder.group({
          firstName: [this.accountService.userValue?.firstName, Validators.required],
          lastName: [ this.accountService.userValue?.lastName, Validators.required],
          username: [ this.accountService.userValue?.username, Validators.required],
          // password only required in add mode
          password: ['', [Validators.minLength(6), ...(!this.id ? [Validators.required] : [])]]
      });
  }

  // convenience getter for easy access to form fields
  get f() { return this.form.controls; }

  onSubmit() {
      this.submitted = true;

      // stop here if form is invalid
      if (this.form.invalid) {
          return;
      }

      this.submitting = true;
      this.saveUser()
          .pipe(first())
          .subscribe({
              next: () => {
                  this.submitting = false;
              },
              error: error => {
                  //this.alertService.error(error);
                  this.submitting = false;
              }
          })
  }

  private saveUser() {
      // create or update user based on id param
      return this.accountService.update(this.form.value)
  }

}
