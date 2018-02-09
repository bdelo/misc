# Bobby DeLorenzo 
#
# class Heap - integer heap implemented with an array
# @is_min boolean (default: true) - true if min is min heap, false if heap is max heap
# public methods: 
# 	int peek() - returns root of the heap, keeps the element in the heap
#   void insert(int) - insert an integer into the heap
#   int poll() - removes the root of the heap and returns it
#   

class Heap
  attr_accessor :size, :items
  def initialize(is_min = true)
    @is_min = is_min
    @comparator = is_min ? :< : :>
    @items = []
    @size = 0
  end

  def peek
    return @items[0]
  end

  def insert(val)
    @items << val
    @size += 1
    heapify_up()
  end

  def poll
  	if @size < 1
  	  return nil
  	else
	  retval = @items[0]
	  swap_indexes(0, size - 1)
	  @items.delete_at(size - 1)
	  @size += -1
	  heapify_down()
      return retval
    end
  end

  private 

  def heapify_up
    index = size - 1
    while index != 0 && @items[index].send(@comparator, @items[parent_index(index)]) do
      swap_indexes(index, parent_index(index))
      index = parent_index(index)
    end
  end

  def heapify_down
    index = 0
    while has_left_child?(index) do
      swappable_child_index = left_child_index(index)
      if has_right_child?(index) && @items[right_child_index(index)].send(@comparator, @items[left_child_index(index)])
        swappable_child_index = right_child_index(index)
      end

      if @items[index].send(@comparator, @items[swappable_child_index])
        break
      else
        swap_indexes(index, swappable_child_index)
      end
      index = swappable_child_index
    end
  end

  def swap_indexes(i,j)
    temp = @items[i]
    @items[i] = @items[j]
    @items[j] = temp
  end

  def parent_index(i)
    return (i / 2).floor
  end

  def has_left_child?(i)
  	return !@items[left_child_index(i)].nil?
  end

  def left_child_index(i)
    return 2 * i + 1
  end

  def has_right_child?(i)
  	return !@items[right_child_index(i)].nil?
  end

  def right_child_index(i)
    return 2 * i + 2
  end
end
