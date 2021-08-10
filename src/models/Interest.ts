export interface InterestType {
  id: number,
  title: string,
  type: string,
}

export class Interest implements InterestType {
  constructor(
    public readonly id: number,
    public readonly title: string,
    public readonly type: string,
  ) {
  }
}
