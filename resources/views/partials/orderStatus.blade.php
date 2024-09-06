@if($purchase->status == 'pending')
                        <span class="badge badge-pill badge-warning">Pending</span>
                    @elseif($purchase->status == 'processed')
                        <span class="badge badge-pill  badge-success">Processed</span>
                    @elseif($purchase->status == 'rejected')
                        <span class="badge badge-pill  badge-danger">Rejected</span>
                    @else 
                    {{$purchase->status}}
                    @endif 