import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MonigoteComponent } from './monigote.component';

describe('MonigoteComponent', () => {
  let component: MonigoteComponent;
  let fixture: ComponentFixture<MonigoteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [MonigoteComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(MonigoteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
