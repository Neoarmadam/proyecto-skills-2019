import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ElFooterComponent } from './el-footer.component';

describe('ElFooterComponent', () => {
  let component: ElFooterComponent;
  let fixture: ComponentFixture<ElFooterComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ElFooterComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ElFooterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
